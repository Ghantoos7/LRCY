import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { EventService } from 'src/app/services/event.service';
import { NavController } from '@ionic/angular';
import { ActivatedRoute } from '@angular/router';
import { SharedService } from 'src/app/services/shared.service';
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

  constructor(private shared:SharedService, private route: ActivatedRoute, private navCtrl: NavController, private router:Router, private service:EventService) { }

  ngOnInit() {
    this.my_id = this.shared.getVariableValue();
    
    this.service.get_event_pictures(this.my_id).subscribe(response => {
     
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
