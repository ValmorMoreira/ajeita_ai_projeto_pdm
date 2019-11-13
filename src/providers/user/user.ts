import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

/*
  Generated class for the UserProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class UserProvider {
  apiCadastro = 'http://localhost/spotted/cadastroApi';
  apiLogin = 'http://localhost/spotted/login/api';

  // constructor(public http: HttpClient) {
  //   console.log('Hello UserProvider Provider');
  // }
  constructor(public http: HttpClient) {
    console.log('Hello UserProvider Provider');
  }


  heloow(){
    console.log("BoaS")
  }

  addContact(data) {
    return new Promise((resolve, reject) => {
      this.http.post(this.apiCadastro + '', data)
        .subscribe(res => {
          resolve(res);
        }, (err) => {
          reject(err);
        });
    });
  }

  login(data){
    return new Promise((resolve, reject) => {
      this.http.post(this.apiLogin + '', data)
        .subscribe(res => {
          resolve(res);
        }, (err) => {
          reject(err);
        });
    });
  }
}
