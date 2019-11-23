import {Component} from "@angular/core";
import {
  IonicPage,
  NavController,
  NavParams,
  ToastController
} from "ionic-angular";
import {UserProvider} from "../../providers/user/user";
import {HomePage} from "../home/home";
import {TabsPage} from "../tabs/tabs";


@IonicPage()
@Component({
  selector: "page-cadastro",
  templateUrl: "cadastro.html"
})
export class CadastroPage {
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
    private toast: ToastController
  ) {
    this.model = new Usuario();
    this.model.nome = "Matheus";
    this.model.sobrenome = "Aleixo";
    this.model.senha = "ricardo123";
    this.model.senha1 = "ricardo123";
    this.model.email = "chupaminhapica@gaymail.com";
    this.model.id = null;
  }

  ionViewDidLoad() {
    console.log("ionViewDidLoad CadastroPage");
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
        img: this.model.img,
        id: this.model.id
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

export class Usuario {
  nome: string;
  sobrenome: string;
  senha: string;
  senha1: string;
  email: string;
  img: string;
  id: any;
}
