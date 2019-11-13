import {Component} from '@angular/core';
import {IonicPage, NavController, NavParams,  ToastController
} from 'ionic-angular';
import {HomePage} from "../home/home";
import {TabsPage} from "../tabs/tabs";
import {CadastroPage} from "../cadastro/cadastro";
import {UserProvider} from "../../providers/user/user";

/**
 * Generated class for the LoginPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-login',
  templateUrl: 'login.html',
})
export class LoginPage {
  model: Usuario;
  erroLogin;

  constructor(
    private toast: ToastController,
    public navCtrl: NavController,
    public navParams: NavParams,
    public userProvider: UserProvider) {

      this.model = new Usuario();
      this.model.email = "ricardo@ricardo.comj";
      this.model.senha = "123456789";

  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad LoginPage');
  }


  loginkkk() {
    this.navCtrl.push(TabsPage, {}, {animate: true});

    console.log('Dentro do login');
    // let user = { this.}

    this.userProvider.heloow();

  }



 login() {
    console.log("Login Usuario");

    var data = {
      usuario: {

        email: this.model.email,
        senha: this.model.senha,

      }
    };

    this.userProvider
      .login(data)
      .then((result: any) => {


        this.toast
          .create({ message: "Bem vindo!", duration: 1500 })
          .present();
        this.navCtrl.push(TabsPage, data, { animate: true });
      })
      .catch((error: any) => {
        this.erroLogin = "";
        console.log("Data");
        console.log( data);



        Object.entries(error.error.erros).forEach(([key, value]) => {
          this.erroLogin += `${value} `;

          console.log(key);
          console.log(value);


        });


      });
  }




  cadastro() {
    this.navCtrl.push(CadastroPage, {}, {animate: true});
  }

  logout() {
    this.navCtrl.push(HomePage, {}, {animate: true});
  }

}

export class Usuario {
  nome: string;
  sobrenome: string;
  senha: string;
  senha1: string;
  email: string;
  img: string;
}
