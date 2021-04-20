<template>
    <div class="wrapper">
        
       <div class="grid"></div>
      <div class="lines"></div>
        <h1>
          <span>ERREUR 404</span>
          <span>ERREUR 404</span>
        </h1>
        <h2> Mais t'es où ? Pas là !</h2>

       <div class="logo">

            <div class="logoText">
                <router-link :to="{name: 'home'}">
                    <p> Retour vers Shabadabada</p>
                </router-link>
            </div>
            
        </div>
    </div>
</template>



<script>
export default {
    name: "shabadabada-error404",
    components: {
    },
}
</script>





<style scoped lang="scss">
@import '../scss/main.scss';
@import url('https://fonts.googleapis.com/css2?family=Mr+Dafoe&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Exo:wght@900&display=swap');
.wrapper {
  
  width: 100%;
  height: 100vh;
  margin: 0;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  background: radial-gradient(rgba(#7600bf, 0.5) 0%, transparent 70%), linear-gradient($color-dark-blue-bis 40%, $color-dark-blue 70%);
  perspective: 700px;
  font-size: clamp(10px, 2vw, 20px);
}
.lines {
  $color: #59c1fe;
  position: fixed;
  width: 100vw;
  height: 4em;
  background: linear-gradient(rgba($color-turquoise, 0.2) 20%, $color-turquoise 40%, $color-turquoise 60%, rgba($color-turquoise, 0.2) 80%);
  background-size: 1px 0.5em;
  box-shadow: 0 0 1em rgba($color-turquoise, 0.4);
  transform: translateY(-1em);
  left: 0;
}
h1 {
  position: relative;
  font-family: 'Exo';
  font-size: 9em;
  margin: 0;
  transform: skew(-15deg);
  letter-spacing: 0.03em;
  
  &::after {
    content: '';
    position: absolute;
    top: -1.9em;
    right: 0.05em;
    width: 0.4em;
    height: 0.4em;
    background: 
      radial-gradient(white 3%, rgba(white, 0.3) 15%, rgba(white, 0.05) 60%, transparent 80%),
      radial-gradient(rgba(white, 0.2) 50%, transparent 60%) 50% 50% / 5% 100%,
      radial-gradient(rgba(white, 0.2) 50%, transparent 60%) 50% 50% / 70% 5%;
    background-repeat: no-repeat;
  }
  
  span:first-child {
    display: block;
    text-shadow: 0 0 0.1em #8ba2d0, 0 0 0.2em black,  0 0 5em $color-turquoise;
    -webkit-text-stroke: 0.06em rgba(black, 0.5);
  }
  
  span:last-child {
    position: absolute;
    left: 0;
    top: -0.1rem;
    background-image: linear-gradient($color-dark-blue 25%, #00a1ef 35%, white 50%, $color-dark-blue-bis 50%, $color-dark-purple 50%,$color-pink-f0f 75%);
    -webkit-text-stroke: 0.01em #94a0b9;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
}
h2 {
  font-family: 'Mr Dafoe';
  margin: 0;
  font-size: 5.5em;
  margin-top: -0.6em;
  color: white;
  text-shadow: 0 0 0.05em #fff, 0 0 0.2em $color-pink-f0f, 0 0 0.3em $color-pink-f0f;
  transform: rotate(-7deg);
}
.grid {
  $main: $color-pink-f0f;
  $glow: rgba($color-pink, 0.4);
  background: 
    linear-gradient(transparent 65%, $color-pink-f0f 75%, $main 80%, $color-pink-f0f 85%, transparent 95%),
    linear-gradient(90deg, transparent 65%, $color-turquoise 75%, $main 80%, $color-turquoise 85%, transparent 95%);
  background-size: 30px 30px;
  width: 200vw;
  height: 300vh;
  position: absolute;
  bottom: -120vh;
  transform: rotateX(-100deg);
  -webkit-mask-image: linear-gradient(rgba(0,0,0,1), rgba(0,0,0,0) 80%);
}
.logo {
  
  position: relative;
  bottom: -0.6rem;
            display: flex;
            //background-color: black;
}
.logoText {  
    
    display: block;
}
p {
    text-transform: uppercase;
    text-align: center;
    font-family: "Neoneon";
    font-size: 3rem;
    color: $color-turquoise;
    //font-size: 2rem ;
    margin-left: 1rem;
    text-shadow: 0 0 0.05em #fff, 0 0 0.2em $color-turquoise, 0 0 0.3em $color-turquoise;
    z-index: -1;
}
</style>