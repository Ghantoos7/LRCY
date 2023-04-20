import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { EventService } from 'src/app/services/event.service';
import { ActivatedRoute } from '@angular/router';
import { SharedService } from 'src/app/services/shared.service';
@Component({
  selector: 'app-event-information',
  templateUrl: './event-information.page.html',
  styleUrls: ['./event-information.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class EventInformationPage implements OnInit {
  my_id: string = "";

  events: any = [];
  responsibles: any = [];
  constructor(private shared:SharedService, private route: ActivatedRoute, private service:EventService, private router: Router) { }

  ngOnInit() {

  this.my_id = this.shared.getVariableValue();
    this.service.get_event(this.my_id).subscribe(response => {
      this.events = response;
       this.responsibles = this.events['event']['0']['responsibles'];
   
    });
  }

 ionViewWillLeave() {
  this.shared.setVariableValue(null);
  }

  

  goGallery(){
    this.router.navigate(['/gallery']);
  }

}
