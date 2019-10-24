import {Component} from '@angular/core';
import {IonicPage, NavController, NavParams} from 'ionic-angular';
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

  constructor(
    public navCtrl: NavController,
    public navParams: NavParams,
    public userProvider: UserProvider) {
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad LoginPage');
  }


  login() {
    this.navCtrl.push(TabsPage, {}, {animate: true});

    console.log('Dentro do login');
    let user = { this.}

    this.userProvider.heloow();

  }

  cadastro() {
    this.navCtrl.push(CadastroPage, {}, {animate: true});
  }

  logout() {
    this.navCtrl.push(HomePage, {}, {animate: true});
  }

}
