/*eslint no-unused-vars: 0*/

// import ReactDOM from 'react-dom/client';

// import Greeting from './components/helloworld.jsx';

// document.addEventListener('DOMContentLoaded', () => {
//   const elements = document.getElementsByClassName('ai-chat');
//   Array.from(elements).forEach((element) => {
//     const root = ReactDOM.createRoot(element);
//     root.render(<Greeting name="World" />);
//   });
// });

import '@n8n/chat/style.css';
import {createChat} from '@n8n/chat';

createChat({
  webhookUrl: '',
  webhookConfig: {
    method: 'POST',
    headers: {},
  },
  target: '#n8n-chat',
  mode: 'window',
  chatInputKey: 'chatInput',
  chatSessionKey: 'sessionId',
  metadata: {},
  showWelcomeScreen: false,
  defaultLanguage: 'en',
  initialMessages: [
    'Hi there! 👋',
    'My name is Nathan. How can I assist you today?',
  ],
});
