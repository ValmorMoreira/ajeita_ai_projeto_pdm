import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import {HomePage} from "../home/home";
import {CadastroPage} from "../cadastro/cadastro";

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

  constructor(public navCtrl: NavController, public navParams: NavParams) {
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad LoginPage');
  }


  login(){
    this.navCtrl.push(HomePage, {}, {animate: true} );

  }

  cadastro(){
    this.navCtrl.push(CadastroPage, {}, {animate: true} );

  }

}
