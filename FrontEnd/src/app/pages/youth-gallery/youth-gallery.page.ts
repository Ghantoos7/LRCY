import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Route, Router } from '@angular/router';
import { MenuController } from '@ionic/angular';
import { EventService } from '../../services/event.service';
import { NavController } from '@ionic/angular';
import { EventPicturesPage } from '../event-pictures/event-pictures.page'; 
import { EventInformationPage } from '../event-information/event-information.page'; 
import { SharedService } from '../../services/shared.service';


@Component({
  selector: 'app-youth-gallery',
  templateUrl: './youth-gallery.page.html',
  styleUrls: ['./youth-gallery.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class YouthGalleryPage implements OnInit {

  constructor(private sharedService: SharedService, private navCtrl: NavController, private event_service:EventService, private router:Router, private menuCtrl: MenuController) { }
  youth_events: any = [];
  events: any = [];
  showActivities: boolean = true;
  showTrainings: boolean = true;
  showOthersEvents: boolean = true;

  ngOnInit() {
    this.event_service.get_events().subscribe(response => {

      this.events = response;
      console.log(this.events);
      this.youth_events = Array.from(this.events['events']['1']);
     
    });

  }
  seeDetails(event_id: string) {
  this.sharedService.setVariableValue(event_id);
    this.router.navigate(['/event-details']);
  }
    

  reset(){
    this.showActivities= true;
  this.showTrainings = true;
  this.showOthersEvents = true;
  }

  showActivity() {
    this.showActivities = true;
    this.showTrainings = false;
    this.showOthersEvents = false;
  }
  
  showTraining() {
    this.showActivities = false;
    this.showTrainings = true;
    this.showOthersEvents = false;
  }
  
  showOthers() {
    this.showActivities = false;
    this.showTrainings = false;
    this.showOthersEvents = true;
  }

  ionViewWillLeave() {
    this.menuCtrl.enable(false, 'menuYouth');
  }

  ionViewDidEnter() {
    this.menuCtrl.enable(true, 'menuYouth');
  }


  
  goProfile(){
this.router.navigate(['/profile']);
  }

  goFeed(){
    this.router.navigate(['/feed']);
  }
  
  goGoals(){
    this.router.navigate(['/yearly-goals']);
  }

  goGallery(){
    this.router.navigate(['/gallery']);
  }

  goAnnouncements(){
    this.router.navigate(['/announcements']);
  }

  toggleDarkMode(){

  }
  logout(){
  
  }
}
