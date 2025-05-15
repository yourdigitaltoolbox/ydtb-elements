// import logo from './logo.svg'

setInterval(() => {
  console.log('ran here');
}, 1000)

document.addEventListener('readystatechange', (e) => {
  console.log('state change', e);
})

console.log('message');

alert('message');