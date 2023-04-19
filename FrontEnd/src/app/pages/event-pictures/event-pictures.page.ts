import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { EventService } from 'src/app/services/event.service';
import { NavController } from '@ionic/angular';

@Component({
  selector: 'app-event-pictures',
  templateUrl: './event-pictures.page.html',
  styleUrls: ['./event-pictures.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class EventPicturesPage implements OnInit {
  my_id: string = "";
  pictures: any = [];

  constructor(private navCtrl: NavController, private router:Router, private service:EventService) { }

  ngOnInit() {
    const data = this.router.getCurrentNavigation()?.extras.state;
    const event_id = JSON.stringify(data);
    const id = JSON.parse(event_id)["id"];
    this.my_id = id;
    this.service.get_event(this.my_id).subscribe(response => {
      const info = JSON.stringify(response);
      this.pictures = response;
 
   
    });
  }

  ionViewWillLeave() {
    
    const navigation = this.router.getCurrentNavigation();
    if (navigation && navigation.extras && navigation.extras.state) {
      navigation.extras.state = { id: null };
    }
  }
}
