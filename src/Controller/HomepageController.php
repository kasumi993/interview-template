<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Ideas;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\IdeasRepository;



class HomepageController extends AbstractController
{
    #[Route('', name: 'homepage')]
    public function index(Request $request,EntityManagerInterface $manager,UserRepository $userRepo,IdeasRepository $ideaRepo): Response
    {


//Je crée un utilisateur fictif pour l'instant pour ne pas gerer la connexion et l'inscription
        $user=$userRepo->findOneBy(["id"=>"1"]);


//########    Posts CREATION Handler  #############

        //get the request
        if($request->request->count()>0){
            //create a new idea object
            $idea = new Ideas();
            $idea->setIdeaTitle($request->request->get('title'))
                ->setIdeaContent($request->request->get('content'))
                ->setIdeaAuthor($user)
                ->setCreatedAt(new \DateTimeImmutable('now'))
            ;

            
            $manager->persist($idea);
            $manager->flush();

        }
        

//#############  END OF Posts CREATION Handler #########



//############# Posts Rendering Handler #########

//retrieve idea informations : all
$ideas=$ideaRepo->findAll();


//#############  End Of  Posts Rendering Handler #########






//#############  Gestion Envoi des données #########

        return $this->render('homepage/index.html.twig', [
            //sending props
            'props'=>array(
                //sending user name
                'name' => $request->query->get('name', $user->getFirstName()),
                'ideas' =>$ideas
            ),
        ]);
    }





    public function createUser($user){
        $user=new User($user);
    }
}
