import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { MenuController } from '@ionic/angular';
import { Router } from '@angular/router';
import { AdminService } from 'src/app/services/admin.service';

@Component({
  selector: 'app-manage-gallery',
  templateUrl: './manage-gallery.page.html',
  styleUrls: ['./manage-gallery.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
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
    this.service.getEvents(this.branch_id).subscribe((response: any)=>{
      const parsedResponse = JSON.parse(JSON.stringify(response));
      this.events=parsedResponse['events'];
      this.yah_events=this.events['youth&health'];
      this.environment_events=this.events['environment'];
      this.hvp_events=this.events['hvp'];
      this.other_events=this.events['other'];
      console.log(this.yah_events, this.environment_events, this.hvp_events, this.other_events)
    });

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

  goToPanel(){
    this.router.navigate(['/panel']);
  }

  closeMenu() {
    this.menuController.close();
  }


}
