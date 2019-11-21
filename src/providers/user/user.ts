import {HttpClient} from '@angular/common/http';
import {Injectable} from '@angular/core';
import {Storage} from '@ionic/storage';

const USER = 'usuario';

@Injectable()
export class UserProvider {
  apiCadastro = 'http://localhost/spotted/cadastroApi';
  apiAtualiza = 'http://localhost/spotted/atualizaApi';
  apiLogin = 'http://localhost/spotted/login/api';

  // constructor(public http: HttpClient) {
  //   console.log('Hello UserProvider Provider');
  // }
  constructor(public http: HttpClient, public storage: Storage) {
    console.log('Hello UserProvider Provider');
  }


  heloow() {
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


  atualizaContato(data) {
    return new Promise((resolve, reject) => {
      this.http.post(this.apiAtualiza + '', data)
        .subscribe(res => {
          resolve(res);
        }, (err) => {
          reject(err);
        });
    });
  }

  login(data) {
    return new Promise((resolve, reject) => {
      this.http.post(this.apiLogin + '', data)
        .subscribe(res => {
          resolve(res);
        }, (err) => {
          reject(err);
        });
    });
  }

  storedUsuario(usuario) {

    if (usuario) {
      console.log(usuario);
       this.storage.set("USER", usuario);
    }else{
      console.log("Error!!!!!!!!!!!!");
    }
  }
}
