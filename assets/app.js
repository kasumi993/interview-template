/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

import React from 'react';
import ReactDOM from 'react-dom';
import PostIdea from './components/PostIdea';
import IdeaFlow from './components/IdeaFlow';
import SideNavBar from './components/SideNavBar';

// start the Stimulus application
import './bootstrap';
// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

//import images
import logo from './images/logo.svg'


const Component = ({props}) => {
  console.log(props);

  return <div className="row">
    <SideNavBar props={props.name}/>
    <main className="col-10">
      <div className="row-2 header"><img src={logo} alt="logo" width="130vw"/></div>
      <PostIdea className="row-2 new-idea"/>
      <IdeaFlow props={props.ideas} className="row-8 flow"/>
    </main>
  </div>
 ;

}

const root = document.getElementById('react-root');
ReactDOM.render(React.createElement(Component, JSON.parse(root.dataset.props)), root);
