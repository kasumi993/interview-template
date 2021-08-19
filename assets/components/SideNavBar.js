import React from 'react';


export default function SideNavBar({name}){
    return <aside className="col-2">
            <h1>Bienvenue {name} !</h1>
            <div className="options">
                <ol>
                <li>Communaute</li>
                <li>mes votes</li>
                </ol>
            </div>
        </aside>
}