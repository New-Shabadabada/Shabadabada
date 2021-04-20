<template>
   <v-container class="container">
    <h1 class="titlePage">Notre Dream Team</h1>
    <v-layout row wrap justify-center class="mb-2 layoutG">
      <v-flex xs8 lg6>
         <v-carousel 
         class="carousel"
         show-arrows-on-hover
         
         hide-delimiters
         >
          <v-carousel-item
            v-for="(item,i) in items"
            :key="i"  
            :src="item.src"
          >
              <v-container
                fluid

              >
                  <v-layout>
                    <v-flex xs12  class="ml-2 mt-2">
                      <div color="transparent" class="mb-0">
                        <h2 class="name font-weight-bold" >{{slides[i]}}</h2>
                      </div>
                    </v-flex>
                  </v-layout>

                  <v-layout class="ml-2 mb-16 pb-16">
                    <v-flex xs12 >
                      <div color="transparent" class="mb-10">
                        <!-- white--text -->
                        <span class="role " >{{role[i]}}</span>
                      </div>
                    </v-flex>
                  </v-layout>

                  <v-layout class="mottoGroupe pt-16">
                    <v-flex>
                      <div  class="motto" >
                        <span>{{motto[i]}}</span>
                      </div>
                    </v-flex>
                  </v-layout>

              </v-container>

            </v-carousel-item>

           </v-carousel>

        </v-flex>

      </v-layout>

    </v-container>

</template>

<script>

export default {

    name: "shabadabada-team",

    data () {

      return {

         items: [
          {
            src: require('../images/amande.jpg')
          },
          {
            src: require('../images/jd.jpg')
          },
          {
            src: require('../images/solene.jpg')
          },
        
        ],
     

        slides: [
          'Amandine Floucaut',
          'JD Stibling',
          'Solène Pilliard',
        ],
      
        motto: [
          'Elle attend que le monde change',
          'Il jouait du piano debout',
          'Elle est pas d\'accord, elle est passionnée',
        ],

        role: [
          'Git master & Lead dev back',
          'Scrum master & Lead dev front',
          'Product owner & dev fullstack',
        ]
      }
    },
}

</script>


<style scoped lang="scss">

@import '../scss/main.scss';

.container{

  min-height: 100vh;
  height : 100%;

  
  .carousel{

    box-shadow: 1px 1px 8px rgba(172, 168, 168,1);

    .name,
    .role {

      font-family: "Montserrat" !important;
    }
  }

  .v-layout {

    font-family: "Montserrat";
  }

  .motto{

    align-self: flex-end;
    font-size: 1.2rem;
    text-align: center;
    font-family: "Lazer84";
    color: black;
    background-color: rgba(194, 190, 190, 0.4);
    text-shadow: 2px 2px $color-turquoise;
    word-spacing: 0.3rem;
    letter-spacing: 0.1rem;

    span{

      padding-top : 0.5rem;
    }
  }
  
  .titlePage{

    font-family: "Lazer84";
    color: $color-turquoise;
    font-size: 2.5rem;
    word-spacing: 1rem;
    text-shadow: 2px 1.5px $color-pink-f0f;
    font-size: 2rem;
    text-align: center;
    padding: 0rem 2rem 2rem 2rem;
    margin : 2rem 0rem 1rem 0rem;
    min-width: 100%;
    width: 100%;
      
  }

  div.container{
      padding:0;
    }

}

// ========= Media queries =========// 
  
@include screen-small{

  .container{
    
    .motto{
        height: 3.2rem; 
        max-height : 8rem;
        font-size: 0.7rem;
        padding-top : 0rem;
        padding-bottom: 1rem;
        margin-top :10.1rem;
        span{
          display : block;
          padding-top : 0.3rem;
        }
    }
  }
}

h1 {
  font-family: "Lazer84";
  color: $color-turquoise;
  font-size: 2.5rem;
  word-spacing: 1rem;
  text-shadow: 2px 1.5px $color-pink-f0f;
  font-size: 2rem;
  text-align: center;
}
    
@include screen-medium{

  .container{

    .motto{

        height: 3.5rem;
        font-size: 1rem;
        margin-top : 9.8rem;

        span{

          display : block;
          margin : auto;
          padding-top : 0.5rem;
          text-align: center;
        }
    }
  }
}

@include screen-large{

  .container{

    .motto{
        height:3rem;
        font-size: 1.1rem;
        margin-top : 11.5rem;
        span{
          display : block;
          margin : auto;
          padding-top : 0rem;
          text-align: center;
        }
    }
  }
}

</style>