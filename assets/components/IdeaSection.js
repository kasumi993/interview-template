import React,{useRef} from 'react';
import '../styles/IdeaSection.css';
import axios from 'axios';

export default function IdeaSection({props}){
    const likeButton = useRef();
    const dislikeButton = useRef();
    const user=localStorage.getItem('user');
 

    function handlePositiveVote(event){
        event.preventDefault();
        const url="/liked/"+props.id+"/true";

        axios.get(url).then(function(response)
        {
            if(response.data['action']=="add"){
                likeButton.current.className="fa fa-thumbs-up liked";
                likeButton.current.textContent=props.ideaVotes[0]+1;
            }else{
                likeButton.current.className="fa fa-thumbs-up";
                likeButton.current.textContent=props.ideaVotes[0]-1;
            }
        })
    }


    function handleNegativeVote(event){
        event.preventDefault();
        const url="/liked/"+props.id+"/false";
        axios.get(url).then(function(response){
            console.log(response);
            if(response.data['action']=="add"){
                dislikeButton.current.className="fa fa-thumbs-down disliked";
                dislikeButton.current.textContent=props.ideaVotes[0]+1;
            }else{
                dislikeButton.current.className="fa fa-thumbs-down";
                dislikeButton.current.textContent=props.ideaVotes[1]-1;
            }
        })
    }

    return <div className="ideaBox container col">
        <div className="row title">{props.ideaTitle}</div>
        <div className="row content">{props.ideaContent}</div>
        <div className="row meta">
            <div className="col"><i className="fa fa-user-circle"></i> {props.ideaAuthor}</div>
            <div className="col"><i className="fa fa-clock"></i> {props.ideaDate.date.toString().split(" ")[0]}</div>
            <div className="col-2" ><button  className="button" onClick={handlePositiveVote}><i ref={likeButton} className="fa fa-thumbs-up like"> {props.ideaVotes[0]}</i></button></div>   
            <div className="col-2"><button  className="button" onClick={handleNegativeVote}><i ref={dislikeButton} className="fa fa-thumbs-down dislike"> {props.ideaVotes[1]}</i></button>   </div>   
        </div>
    </div>
}