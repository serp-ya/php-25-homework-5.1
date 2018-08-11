window.addEventListener('load', () => {
  const mapContainer = document.createElement('div');
  mapContainer.id = 'yaMap';
  mapContainer.style.height = '400px';
  document.body.appendChild(mapContainer);
  
  ymaps.ready(init);
  
  function init(){   
    const myMap = new ymaps.Map("yaMap", {
      center: [55.76, 37.64],
      zoom: 7
    });
  }
});
