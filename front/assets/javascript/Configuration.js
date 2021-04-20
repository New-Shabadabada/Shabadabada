// WIP not use for now but useful to dynamise the endpoint later
// console.log('%c' + "configuration.js loaded", 'color: #0bf; font-size: 1rem; background-color:#fff');


export default class Configuration 
{

environments = {

  _default: {
    urls: {
      
      musicList: '/wp-json/wp/v2/music?_embed',
      playlist : '/wp-json/shabadabada/v1/create-game',
      categories: '/wp-json/wp/v2/music-type',
    },
  },

    development : {
        regex: /localhost/,
        apiURLRoot: 'http://localhost/Shabadabada/public/front',
    },

    production : {
        apiURLRoot: 'http://ec2-54-211-13-201.compute-1.amazonaws.com/apo-Shabadabada/public',
        baseURI: '/public/front',
    },
}

currentEnvironmentName;
currentEnvironment;

constructor(environment = null) {

    if(!environment) {
      environment = this.detectEnvironment();
    }

    this.currentEnvironmentName = environment;
    this.currentEnvironment = this.environments[this.currentEnvironmentName];

    //console.log(this.currentEnvironment);
    //console.log(this.currentEnvironmentName);
  }

  getBaseURI() {
    
    let baseURI = '';
    if(this.environments[this.currentEnvironmentName].baseURI) {
      baseURI = this.environments[this.currentEnvironmentName].baseURI
    }
    console.log(this.baseURI);
    return baseURI;
  }

  getURL(name) {
    // vérifie si un bloc "urls" a été configuré
    if(typeof(this.environments[this.currentEnvironmentName].urls) !== 'undefined') {

      // si un bloc url a été configuré, vérifie si la route demandé existe
      if(typeof(this.environments[this.currentEnvironmentName].urls[name]) !== 'undefined') {
        // retourne l'url demandée en fonction de la route
        return (
          this.currentEnvironment.apiURLRoot +
          this.environments[this.currentEnvironmentName].urls[name]
        );
      }
    }

    // si l'url n'a pas été trouvée dans l'environnement demandé , retourne l'url en se basant sur la configuration par défaut
    // il faudrait tester est ce que l'url existe dans l'environnement par défaut
    return (
      this.currentEnvironment.apiURLRoot +
      this.environments['_default'].urls[name]
    );
  }

  getCurrent() {
    return this.currentEnvironment;
  }

  detectEnvironment() {
    // récupération de l'url demandée par le visiteur
    let currentURL = document.location.toString()

    // par défaut l'environnement est production
    let environment = 'production';

    // on parcourt tous les enviromments que nous avons configurés
    for(let environmentName in this.environments) {

      // on récupère la configuration
      let configuration = this.environments[environmentName];

      // DOC regex js https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/match
      // s'il y a une regex configurée, on teste la regexp
      if(configuration.regex) {
        // si la regexp est validée alors ça veut dire que l'on a détecté le bon environnement
        if(currentURL.match(configuration.regex)) {
          return environmentName;
        }
      }
    }
    return environment;
  }
}
