import { Component } from '@angular/core';
import {NavController, NavParams} from 'ionic-angular';
import {Usuario} from "../cadastro/cadastro";

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {

  usuario: Usuario;

  constructor(public navCtrl: NavController,public navParams: NavParams) {
   let nome = navParams.get('nome');
   let email = navParams.get('email');
   let id = navParams.get('id');
   console.log(navParams);
  }

}
