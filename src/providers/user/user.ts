import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

/*
  Generated class for the UserProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class UserProvider {
  apiUrl = 'http://localhost/spotted/cadastroApi';

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
      this.http.post(this.apiUrl + '', data)
        .subscribe(res => {
          resolve(res);
        }, (err) => {
          reject(err);
        });
    });
  }
}
