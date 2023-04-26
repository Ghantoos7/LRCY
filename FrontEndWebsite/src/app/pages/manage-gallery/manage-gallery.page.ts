import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { MenuController } from '@ionic/angular';
import { ActivatedRoute, Router, NavigationEnd } from '@angular/router';
import { AdminService } from 'src/app/services/admin.service';
import { ReactiveFormsModule } from '@angular/forms';


@Component({
  selector: 'app-manage-gallery',
  templateUrl: './manage-gallery.page.html',
  styleUrls: ['./manage-gallery.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule,ReactiveFormsModule]
})
export class ManageGalleryPage implements OnInit {

  branch_id = localStorage.getItem('branch_id') as string;
  events: any=[];
  yah_events: any=[];
  environment_events: any=[];
  hvp_events: any=[];
  other_events: any=[];
  constructor(private menuCtrl: MenuController, private router:Router, private menuController: MenuController, private service:AdminService) { }

  ngOnInit() {
    this.router.events.subscribe((event) => {
      if (event instanceof NavigationEnd && event.url === '/manage-gallery') {
        this.fetchEvents();
      }
    });

  }

  fetchEvents(){
    this.service.getEvents(this.branch_id,"").subscribe((response: any)=>{
      const parsedResponse = JSON.parse(JSON.stringify(response));
      this.events=parsedResponse['events'];
      this.yah_events=this.events['Youth and Health'];
      this.environment_events=this.events['Environment'];
      this.hvp_events=this.events['HVP'];
      this.other_events=this.events['Others'];
    });
  }

  mapEventIcon(event_type_id: number) : string{
    if(event_type_id == 1){
      return "calendar-number-outline";
    }
    else if(event_type_id == 2){
      return "barbell-outline";
    }
    else{
      return "ellipsis-horizontal-outline";
    }
  }

  goToAddForm(){
    this.router.navigate(['/add-gallery'])
  }
  ionViewWillLeave() {
    this.menuCtrl.enable(false, 'menuGallery');
  }

  ionViewDidEnter() {
    this.menuCtrl.enable(true, 'menuGallery');
  }

  goToHome(){
    this.service.logout().subscribe((response: any) => {
      localStorage.clear();
      this.router.navigate(['/home']);
   });
  }

  goToEditGallery(event : any){
    this.router.navigate(['/edit-gallery'] ,{ state: { event: event } });
  }

  goToPanel(){
    this.router.navigate(['/panel']);
  }

  closeMenu() {
    this.menuController.close();
  }


}
