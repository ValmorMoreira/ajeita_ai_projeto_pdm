import {Component} from '@angular/core';
import {IonicPage, NavController, NavParams, ToastController} from 'ionic-angular';
import {Usuario} from "../cadastro/cadastro";
import {UserProvider} from "../../providers/user/user";
import {TabsPage} from "../tabs/tabs";
import {Storage} from '@ionic/storage';


@IonicPage()
@Component({
  selector: 'page-perfil',
  templateUrl: 'perfil.html',
})
export class PerfilPage {

  erroCadastro = "";
  model: Usuario;
  photo: string = "";

  errorEmail: string;
  errorNome: string;
  errorSobrenome: string;
  errorSenha: string;


  constructor(
    public navCtrl: NavController,
    public navParams: NavParams,
    public userProvider: UserProvider,
    private toast: ToastController,
    private storage: Storage
  ) {
    this.model = new Usuario();

    storage.get("USER").then((user) => {
      console.log("dados: ");
      console.log(user);
      console.log(user.usuario.nome);

     this.model.nome = user.usuario.nome;
     this.model.sobrenome = user.usuario.sobrenome;
     this.model.senha = "";
     this.model.senha1 = "";
     this.model.email = user.usuario.email;

    });




  }


  salvarUser() {
    console.log("Salvando usuário");

    var data = {
      usuario: {
        nome: this.model.nome,
        sobrenome: this.model.sobrenome,
        senha: this.model.senha,
        senha1: this.model.senha1,
        email: this.model.email,
        img: ""
      }
    };

    this.userProvider
      .atualizaContato(data)
      .then((result: any) => {
        console.log(data);

        this.toast
          .create({message: "Usuario editado com susesso", duration: 3000})
          .present();
        this.navCtrl.push(TabsPage, data, {animate: true});
      })
      .catch((error: any) => {
        this.erroCadastro = "";
        console.log(data);

        console.log(error);
        Object.entries(error.error.erros).forEach(([key, value]) => {
          this.erroCadastro += `${value} <br><br>`;
          console.log(key);
          switch (key) {
            case "nome":
              this.errorNome = value;
              break;
            case "sobrenome":
              this.errorSobrenome = value;
              break;
            case "conf":
              this.errorSenha = value;
              break;
            case "senha":
              this.errorSenha = value;
              break;
            case "senha1":
              this.errorSenha = value;
              break;
            case "email":
              this.errorEmail = value;
              break;
          }
          console.log(value);
        });
      });
  }


  ionViewDidLoad() {
    console.log('ionViewDidLoad PerfilPage');
  }

}

