import React from 'react';
import '../styles/SideNavBar.css';
//import images
import logo from '../images/logobleu.svg';

export default function SideNavBar(){
    return <div >
            <div className="header"><img src={logo} alt="logo" width="160vw"/></div>
            <div className="options">
                <ul>
                    <li><i class="fa fa-users" aria-hidden="true"></i> Community</li>
                    <li><i class="fa fa-thumbs-up" aria-hidden="true"></i> My votes</li>
                </ul>
            </div>
        </div>
}