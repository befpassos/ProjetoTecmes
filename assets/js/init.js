document.addEventListener('DOMContentLoaded', function() {
    var sidenav = document.querySelectorAll('.sidenav');
    var dropdown = document.querySelectorAll('.dropdown-trigger');

    M.Sidenav.init(sidenav, {
      menuWidth: 300, // Default is 300
      edge: 'left', // Choose the horizontal origin
      closeOnClick: false, // Closes side-nav on <a> clicks, useful for Angular/Meteor
      draggable: true, // Choose whether you can drag to open on touch screens
      inDuration: 250
    });

    M.Dropdown.init(dropdown, {
      coverTrigger: false
    });
  });