import React from 'react';
import IdeaSection from './IdeaSection';

export default function Idea({props}){
    console.log(props);
    const ideaSections=props.map((idea,index)=>{
        return <IdeaSection key={index} props={idea}/>
    })

    return <div>
        {ideaSections}
    </div>
}