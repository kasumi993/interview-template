/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

import React, { useState } from 'react';
import ReactDOM from 'react-dom';
import PostIdea from './components/PostIdea';
import IdeaFlow from './components/IdeaFlow';
import SideNavBar from './components/SideNavBar';

// start the Stimulus application
import './bootstrap';
// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';


const Component = ({props}) => {
  const [state, setState] = useState(props);

  return <div className="row">
    <div className="background"></div>
    <aside className="col-2"> 
      <SideNavBar />
    </aside>
    <main className="col">
      <div className="container-fluid">
        <h1 className="row welcome">Welcome back {state.name} !</h1>
        <div className="row">
          <div className="col-8">
            <IdeaFlow props={state.ideas}/>
          </div>
          <div className="col">
            <PostIdea/>
          </div>
        </div>
      </div>  
    </main>
  </div>
 ;

}

const root = document.getElementById('react-root');
ReactDOM.render(React.createElement(Component, JSON.parse(root.dataset.props)), root);
