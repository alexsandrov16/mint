/**
 * SideNav Menu
 */
//Open
function openNav() {
    if (!document.querySelector('.sidenav').hasAttribute('style')) {
        document.body.style.overflow = 'hidden';

        let mask = document.createElement("div");
        document.body.appendChild(mask);
        mask.className = 'sidenav-mask';

        document.querySelector('.sidenav').style.transform = 'none';
    }
}
//Close
document.onclick = (e) => {
    if (e.target == document.querySelector('.sidenav-mask')) {
        document.body.removeAttribute('style');
        document.querySelector('.sidenav').removeAttribute('style');
        document.body.removeChild(document.querySelector('.sidenav-mask'))
    }
}