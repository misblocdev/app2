
<script>
let vh = window.innerHeight * 0.01
document.documentElement.style.setProperty('--vh', `${vh}px`)
window.addEventListener('resize', () => {
  let vh = window.innerHeight * 0.01
  document.documentElement.style.setProperty('--vh', `${vh}px`)
})
</script>

<?php 
include_once(G5_PATH.'/tail.sub.php');
?>