<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Ideas;
use App\Entity\User;
use App\Entity\Votes;
use App\Repository\UserRepository;
use App\Repository\IdeasRepository;
use App\Repository\VotesRepository;

class HomepageController extends AbstractController
{
    #[Route('', name: 'homepage')]
    public function index(Request $request,EntityManagerInterface $manager,UserRepository $userRepo,VotesRepository $VotesRepo,IdeasRepository $ideaRepo): Response
    {


//Je crée un utilisateur fictif pour l'instant pour ne pas gerer la connexion et l'inscription
        $user=$userRepo->findOneBy(["id"=>"1"]);


//########    idea CREATION Handler  #############

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
        

//#############  END OF idea CREATION Handler #########



//############# idea Rendering Handler #########

//retrieve idea informations : all
$ideas=$ideaRepo->findAll();

//traitement des données à envoyer
$ideaDetails=array();
        
foreach($ideas as $idea){
    $newIdea=[
        "ideaTitle"=>$idea->getIdeaTitle(),
        "ideaContent"=>$idea->getIdeaContent(),
        "ideaAuthor"=>$idea->getIdeaAuthor()->getPseudo(),
        "ideaDate"=>$idea->getCreatedAt(),
        "ideaVotes"=>$idea->getVotesCount($VotesRepo),
        'isLikedByUser' =>$idea->isLikedByUser($user),
    ];
    
    $ideaDetails[]=$newIdea;
}




//#############  End Of  idea Rendering Handler #########






//#############  Gestion Envoi des données #########

        return $this->render('homepage/index.html.twig', [
            //sending props
            'props'=>array(
                //sending user name
                'user' => $user,
                'name' => $user->getFirstName(),
                'ideas' =>$ideaDetails,
            ),
        ]);
    }




    #[Route('/liked/user/{pseudo}/{password}/{firstName}/{lastName}', name: 'create_user')]
    public function createUser(String $pseudo,String $password,String $firstName,String $lastName,EntityManagerInterface $manager):Response
    {
        $user=new User();
        $user->setId($request->request->get('title'))
            ->setIdeaContent($request->request->get('content'))
            ->setIdeaAuthor($user)
            ->setCreatedAt(new \DateTimeImmutable('now'))
        ;
    }




    //#############  idea like or unlike and dislike Handler #########


    #[Route('/liked/{id}/{voteType}', name: 'idea_like')]
    /**
     *
     * @param String $id
     * @param boolean $voteType
     * @param EntityManagerInterface $manager
     * @param VotesRepository $voteRepo
     * @param UserRepository $userRepo
     * @param IdeasRepository $ideaRepo
     * @return Response
     */
    //user repository will no longer be needed when we implement the connexion module
        public function like(String $id,bool $voteType, EntityManagerInterface $manager,VotesRepository $voteRepo,UserRepository $userRepo,IdeasRepository $ideaRepo):Response{
    
    $user=$userRepo->findOneBy(["id"=>"1"]);

    //get the request
        // //create a new idea object
        $idea=$ideaRepo->findOneBy(['id'=>$id]);

        // //access refusé
        // if(!$user) {
        //     return $this ->json([
        //         'code' =>403,
        //         'message' =>"Unauthorized"
        //     ],403);
        // }


        #vote for an idea

        if($idea->isLikedByUser($user)){
            $vote=$voteRepo->findOneBy([
                'ideaRef'=>$id,
                'VoterRef'=>$user
            ]);

            $manager->remove($vote);
            $manager->flush();

            return $this->json([
                'code' => 200,
                'message'=> 'Like was suppressed',
                'votes'=> $idea->getVotesCount()
            ],200)
            
            ;}

            $vote=new Votes();
            $vote->setVoteType($voteType);
            $vote->setVoterRef($user);
            $vote->setIdeaRef($idea);

            $manager->persist($vote);
            $manager->flush();
            
        
        return $this->json([
            "code"=>200,
            'message'=> 'Like was added',
            'ideas'=> $idea->getVotesCount(),
        ],200);
    }



    //#############  End Of  like or unlike and dislike Handler #########









//#############  suppress idea Handler  #########

    #[Route('/idea/suppress/{id}', name: 'idea_suppress')]

/**
 * to suppress an idea
 *
 * @param String $id
 * @param EntityManagerInterface $manager
 * @param UserRepository $userRepo
 * @param IdeasRepository $ideaRepo
 * @return Response
 */
     //user repository will no longer be needed when we implement the connexion module
        public function suppress(String $id,EntityManagerInterface $manager,UserRepository $userRepo,IdeasRepository $ideaRepo):Response{
        
        $user=$userRepo->findOneBy(["id"=>"1"]);
    
        //get the request
            // //create a new idea object
        $idea=$ideaRepo->findOneBy(['id'=>$id]);
    
            #vote for an idea
    
        if($idea->getIdeaAuthor()===$user){
                $manager->remove($idea);
                $manager->flush();            

            return $this->json([
                'code' => 200,
                'message'=> 'Idea have been suppressed',
            ],200)
            
            ;}

            return $this ->json([
                'code' =>403,
                'message' =>"Unauthorized"
            ],403);
        }
    
    
    //#############  End Of suppress idea Handler #########


}
