import {Component} from '@angular/core';
import {IonicPage, NavController, NavParams, ToastController} from 'ionic-angular';
import {UserProvider} from "../../providers/user/user";
import {TabsPage} from "../tabs/tabs";
import {Storage} from '@ionic/storage';


@IonicPage()
@Component({
  selector: 'page-ajeita-ai',
  templateUrl: 'ajeita-ai.html',
})
export class AjeitaAiPage {
  erroCadastro = "";
  model: Usuario;
  modelo: Problema;

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
    this.modelo = new Problema();
    this.modelo.problema = "O bebedor do bloca A não está funcionando";
    this.modelo.descricao = "Já tem algum tempo que o bebedor do bloca A não está funcionando, e com esse calor está muito complicado tomar água quente!";

    this.model = new Usuario();

    storage.get("USER").then((user) => {
      console.log("dados: ");
      console.log(user);
      console.log(user.usuario.nome);

      this.model.nome = user.usuario.nome;
      this.model.id = user.usuario.id;
      this.model.sobrenome = user.usuario.sobrenome;
      this.model.email = user.usuario.email;
      this.model.img = user.usuario.img;

    });
  }

  ionViewDidLoad() {
    console.log("ionViewDidLoad CadastroPage");
  }




  salvarProblema() {
    console.log("Salvando usuário");

    var data = {
      usuario: {
        nome: this.model.nome,
        sobrenome: this.model.sobrenome,
        email: this.model.email,
        img: this.model.img,
        id: this.model.id
      },
      problema: {
        problema: this.modelo.problema,
        descricao: this.modelo.descricao,
        imagem: this.modelo.imagem,
        latitude: this.modelo.latitude,
        longitude: this.modelo.longitude,
        usuarioId: this.model.id,
        dataCriacao: null,
        foiConcertado: null,
        usuarioIdResponsavel: null,
        descricaoDoConcerto: null,
        dataConcerto: null,

      }
    };

    this.userProvider
      .addContact(data)
      .then((result: any) => {
        console.log(data);

        this.toast
          .create({message: "Contato criado com susesso", duration: 1000})
          .present();

        this.userProvider.storedUsuario(result);

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


}

export class Problema {
  problema: string;
  descricao: string;
  imagem: string;
  latitude: string;
  longitude: string;
  usuarioID: number;
  dataCriacao: any;
  foiConcertado: boolean;
  usuarioIdResponsavel: number;
  descricaoDoConcerto: string;
  dataConcerto: string;


}

export class Usuario {
  nome: string;
  sobrenome: string;
  senha: string;
  senha1: string;
  email: string;
  img: string;
  id: any;
}
