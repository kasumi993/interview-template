/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

import React from 'react';
import ReactDOM from 'react-dom';

// start the Stimulus application
import './bootstrap';
// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

//import images
import logo from './images/logo.svg'


const Component = ({ name }) => 
<div className="row">
  <aside className="col-2">
    <h1>Bienvenue {name} !</h1>
    <div className="options">
      <ol>
        <li>Communaute</li>
        <li>mes votes</li>
      </ol>
    </div>
  </aside>
  <main className="col-10">
    <div className="row-2 header"><img src={logo} alt="logo" width="130vw"/></div>
    <div className="row-2 new-idea">MindSyncing? Share your idea...</div>
    <div className="row-8 flow">this is the main stuff</div>
  </main>
</div>
 ;



const root = document.getElementById('react-root');
ReactDOM.render(React.createElement(Component, JSON.parse(root.dataset.props)), root);
