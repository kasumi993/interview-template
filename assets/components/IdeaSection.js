import React from 'react';
import '../styles/IdeaSection.css';

export default function PostIdea({props}){
    console.log(props.ideaTitle);

    function handlePositiveVote(){
        console.log("hello");
    }
    function handleNegativeVote(){
        console.log("hello");
    }

    return <div className="ideaBox container col">
        <div className="row title">{props.ideaTitle}</div>
        <div className="row content">{props.ideaContent}</div>
        <div className="row meta">
            <div className="col"><i class="fa fa-user-circle"></i> {props.ideaAuthor}</div>
            <div className="col"><i class="fa fa-clock"></i> {props.ideaDate.date.toString().split(" ")[0]}</div>
            <div className="col-2"><button className="button" onClick={handlePositiveVote}><i class={props.isLikedByUser ? "fa fa-thumbs-up liked" : "fa fa-thumbs-up"}></i></button>  {props.ideaVotes[0][1]}</div>   
            <div className="col-2"><button className="button" onClick={handleNegativeVote}><i class={props.isLikedByUser ? "fa fa-thumbs-down unliked" : "fa fa-thumbs-down"}></i></button>  {props.ideaVotes[0][1]} </div>   
        </div>
    </div>
}