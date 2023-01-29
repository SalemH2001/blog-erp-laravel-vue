<template>
    <div id="wrapper">
      <!-- sidebar -->
      <div class="sidebar">
        <span class="closeButton">&times;</span>
        <p class="brand-title"><a href="">Alphayo Blog</a></p>

        <div class="side-links">
          <ul>
            <li><RouterLink :to="{name:'Home'}">Home</RouterLink></li>
            <li><RouterLink :to="{name:'Blog'}">Blog</RouterLink></li>
            <li><RouterLink :to="{name:'About'}">About</RouterLink></li>
            <li><RouterLink :to="{name:'Contact'}">Contact</RouterLink></li>            
          </ul>
        </div>

        <!-- sidebar footer -->
        <footer class="sidebar-footer">
          <div>
            <a href=""><i class="fab fa-facebook-f"></i></a>
            <a href=""><i class="fab fa-instagram"></i></a>
            <a href=""><i class="fab fa-twitter"></i></a>
          </div>

          <small>&copy 2021 Alphayo Blog</small>
        </footer>
      </div>
      <!-- Menu Button -->
      <div class="menuButton">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
      </div>
      <!-- main -->
      <main class="container">
        <!-- render components depending on the page visited -->
        <RouterView></RouterView>
      </main>

      <!-- Main footer -->
      <footer class="main-footer">
        <div>
          <a href=""><i class="fab fa-facebook-f"></i></a>
          <a href=""><i class="fab fa-instagram"></i></a>
          <a href=""><i class="fab fa-twitter"></i></a>
        </div>
        <small>&copy: 2023 Salem Blog</small>
      </footer>
    </div>
</template>