/*eslint no-unused-vars: 0*/

import ReactDOM from 'react-dom/client';

import Greeting from './components/helloworld.jsx';

document.addEventListener('DOMContentLoaded', () => {
  const elements = document.getElementsByClassName('ai-chat');
  Array.from(elements).forEach((element) => {
    const root = ReactDOM.createRoot(element);
    root.render(<Greeting name="World" />);
  });
});
