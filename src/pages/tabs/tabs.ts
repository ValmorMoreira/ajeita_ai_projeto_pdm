import { Component } from '@angular/core';

import { HomePage } from '../home/home';
import { PerfilPage} from "../perfil/perfil";
import {AjeitaAiPage} from "../ajeita-ai/ajeita-ai";

@Component({
  templateUrl: 'tabs.html'
})
export class TabsPage {

  tab1Root = HomePage;
  tab2Root = AjeitaAiPage;
  tab3Root = PerfilPage;


  constructor() {

  }
}
