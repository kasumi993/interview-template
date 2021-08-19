import React from 'react';
import '../styles/PostIdea.css';


export default function PostIdea(){
    return <div>
        <form action="" method="POST">
            <label>MindSyncing? Share your idea</label><br/>
           <input type="text" key="title" name="title" placeholder="Idea title..."/> <br/>
           <textarea name="content" placeholder="You wonderful idea here..."></textarea> <br/>
           <input type="submit" value="post my idea" name="submit"/>
        </form>
    </div>
}