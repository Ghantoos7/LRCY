import { Component } from '@angular/core';
import { IonicModule } from '@ionic/angular';
import { HttpClientModule } from '@angular/common/http';
import { Router } from '@angular/router';
import { NavController, Platform } from '@ionic/angular';

@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  styleUrls: ['app.component.scss'],
  standalone: true,
  imports: [IonicModule, HttpClientModule],
})
export class AppComponent {
  constructor(private router: Router, private navCtrl: NavController, private platform:Platform) {
    this.initializeApp();
  }

  initializeApp() {
    this.platform.ready().then(() => {
      const last_page = localStorage.getItem('last_page');
      if (last_page) {
        this.navCtrl.navigateRoot(last_page);
      }
    });
  }  

}
