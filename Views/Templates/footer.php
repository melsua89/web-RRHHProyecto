</section>


<!-- Modal informativo -->
  <div class="modal fade" id="modalExitoso" tabindex="-1" role="dialog" aria-labelledby="modalExitosoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalExitosoLabel">Solicitud Procesada con Éxito</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¡La solicitud se ha procesado exitosamente!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
  </div>


  <!-- Scrip de la Pagina -->
  <script>
    
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    

    closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();//calling the function(optional)
    });

    

    // following are the code to change sidebar button(optional)
    function menuBtnChange() {
   if(sidebar.classList.contains("open")){
     closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
   }else {
     closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
   }
   }
  </script>





  <!-- Submenu -->
  <Script>
      
      // JavaScript para mostrar los submenús en columnas
      document.querySelectorAll('.sidebar li').forEach((item) => {
      const subMenu = item.querySelector('.sub-menu');
        if (subMenu) {
      // Ocultar el submenú al principio
      subMenu.style.display = 'none';    
      item.addEventListener('click', () => {
      // Alternar la visibilidad del submenú y ajustar la dirección flex a "column"
          if (subMenu.style.display === 'none' || subMenu.style.display === '') {
            subMenu.style.display = 'flex';
            subMenu.style.flexDirection = 'column';
          } else {
        subMenu.style.display = 'none';
          }
          
          });
          // Evitar que los clics en subitems cierren el submenú
          subMenu.addEventListener('click', (e) => {
              e.stopPropagation();
        });
        }
      });

  </Script>

      

  

<?php
    

    if (isset($_SESSION['exito_registro']) && $_SESSION['exito_registro'] === true) {
    echo '<script>
            $(document).ready(function() {
                $("#modalExitoso").modal("show");
            });
            

          </script>';
          
    unset($_SESSION['exito_registro']); // Limpia la variable de sesión
   }
?>
<script>
  const base_url = '<?php echo base_url; ?>';
</script>
<script src="<?php echo base_url; ?>assets/JS/tablas.js" ></script>
<script src="<?php echo base_url; ?>assets/JS/selects.js" ></script>
<script src="<?php echo base_url; ?>assets/JS/funciones.js" ></script>
</body>
</html>