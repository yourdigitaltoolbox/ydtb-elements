import '@n8n/chat/style.css';
import {createChat} from '@n8n/chat';

document.addEventListener('initChat', (event) => {
  const {config, style} = (event as CustomEvent).detail;

  // Generate a <style> tag with the CSS variables
  const styleTag = document.createElement('style');
  const cssVariables = Object.entries(style)
    .map(([key, value]) => `${key}: ${value};`) // Use the key directly as it already includes the correct variable name
    .join('\n');
  styleTag.innerHTML = `:root { ${cssVariables} }`;
  document.head.appendChild(styleTag);

  createChat(config);

  const observer = new MutationObserver((mutationsList) => {
    for (const mutation of mutationsList) {
      if (mutation.type === 'childList') {
        const poweredByElement =
          document.querySelector('.chat-powered-by');
        if (poweredByElement) {
          poweredByElement.innerHTML =
            'Powered by <a href="https://yourdigitaltoolbox.com/" target="_blank" rel="noopener noreferrer">Your Digital Toolbox</a>';
          observer.disconnect(); // Stop observing once the element is found and updated
          return; // Use return instead of break to exit the function
        }
      }
    }
  });

  observer.observe(document.body, {childList: true, subtree: true});
});
