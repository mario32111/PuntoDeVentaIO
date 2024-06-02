const elementsList = document.querySelector('.sidebar ul');
const titleList = document.querySelector('.sidebar h2');
$(document).ready(function(){
    $('.sidebar').hover(function(){
        $(this).addClass('active');
        titleList.innerHTML =`Menu`
        elementsList.innerHTML=`                <li><a href="inicio.html"><span class="sidebar-icono"></span>Ventas</a></li>
        <li><a href="registro.php"><span class="sidebar-icono"></span>Registrar producto</a></li>
        <li><a href="proveedores.php"><span class="sidebar-icono"></span>Gestion de proveedores</a></li>
        <li><a href="historial.php"><span class="sidebar-icono"></span>Historial de ventas</a></li>`;
/*                 link.classList.add('.sidebar-icon')
*/ 
    }, function(){
        $(this).removeClass('active');
        titleList.innerHTML =`M`
        elementsList.innerHTML=`                <li><a href="inicio.html"><span></span></a></li>
        <li><a href="registro.php"><span></span></a></li>
        <li><a href="proveedores.php"><span></span></a></li>
        <li><a href="historial.php"><span></span></a></li>`;
    });
});