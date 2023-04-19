import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { EventService } from 'src/app/services/event.service';
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
  constructor(private service:EventService, private router: Router) { }

  ngOnInit() {
    const data = this.router.getCurrentNavigation()?.extras.state;
    const event_id = JSON.stringify(data);
    const id = JSON.parse(event_id)["id"];
    this.my_id = id;
    this.service.get_event(this.my_id).subscribe(response => {
      const info = JSON.stringify(response);
      this.events = response;
 
   
    });
  }

  

  goGallery(){
    this.router.navigate(['/gallery']);
  }

}
