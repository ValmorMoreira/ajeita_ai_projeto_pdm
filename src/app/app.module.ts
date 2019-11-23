import {NgModule, ErrorHandler} from '@angular/core';
import {BrowserModule} from '@angular/platform-browser';

import { HttpModule } from '@angular/http';
import { HttpClientModule } from '@angular/common/http';



import {IonicApp, IonicModule, IonicErrorHandler} from 'ionic-angular';
import {MyApp} from './app.component';

import { IonicStorageModule } from '@ionic/storage';

import {HomePage} from '../pages/home/home';
import {TabsPage} from '../pages/tabs/tabs';

import {StatusBar} from '@ionic-native/status-bar';
import {SplashScreen} from '@ionic-native/splash-screen';
import {LoginPage} from "../pages/login/login";
import {CadastroPage} from "../pages/cadastro/cadastro";
import { UserProvider } from '../providers/user/user';
import {PerfilPage} from "../pages/perfil/perfil";

@NgModule({
  declarations: [
    MyApp,
    CadastroPage,
    HomePage,
    PerfilPage,
    TabsPage,
    LoginPage
  ],
  imports: [
    BrowserModule,
    HttpModule,
    HttpClientModule,
    IonicModule.forRoot(MyApp),
    IonicStorageModule.forRoot()


  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
    CadastroPage,
    HomePage,
    PerfilPage,
    TabsPage,
    LoginPage
  ],
  providers: [
    StatusBar,
    SplashScreen,
    {provide: ErrorHandler, useClass: IonicErrorHandler},
    UserProvider
  ]
})
export class AppModule {
}
