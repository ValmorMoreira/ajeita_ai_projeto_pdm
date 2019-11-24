import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable()
export class ProblemaProvider {

  apiProblemas = 'http://localhost/spotted/problemasApi';
  apiAtualiza = 'http://localhost/spotted/atualizaApi';
  apiLogin = 'http://localhost/spotted/login/api';


  constructor(public http: HttpClient) {
    console.log('Hello ProblemaProvider Provider');
  }


  addProblema(data) {
    return new Promise((resolve, reject) => {
      this.http.post(this.apiProblemas + '', data)
        .subscribe(res => {
          resolve(res);
        }, (err) => {
          reject(err);
        });
    });
  }

}
