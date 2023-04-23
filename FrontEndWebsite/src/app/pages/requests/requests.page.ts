import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { AlertController } from '@ionic/angular';
import { Router } from '@angular/router';
import { AdminService } from 'src/app/services/admin.service';

@Component({
  selector: 'app-requests',
  templateUrl: './requests.page.html',
  styleUrls: ['./requests.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class RequestsPage implements OnInit {

  branch_id = localStorage.getItem('branch_id') as string;
  requests: any=[];

  constructor(private alertController: AlertController, private router:Router, private adminService:AdminService) { }

  ngOnInit() {
    this.adminService.getRequests(this.branch_id).subscribe((data)=>{
      const response=this.requests = data;
      const parsedResponse = JSON.parse(JSON.stringify(response));
      console.log(parsedResponse);
      if (parsedResponse.status == "success") {
        this.requests = parsedResponse.requests;
        console.log(this.requests);
      }
      else{
        this.requests = [];
      }
    }
    );
  }

  async confirmAccept(request_id: string) {
    const alert = await this.alertController.create({
      header: 'Are you sure you want to proceed?',
      cssClass: 'my-custom-class',
      buttons: [
        {
          text: 'Yes',
          handler: () => {
            this.adminService.acceptRequest(request_id).subscribe((data)=>{
              const response = data;
              const parsedResponse = JSON.parse(JSON.stringify(response));
              console.log(parsedResponse);
              if (parsedResponse.status == "success") {
                this.ngOnInit();
              }
            });
          }
        },
        {
          text: 'Cancel',
          role: 'cancel',
        }
      ]
    });
    await alert.present();
  }

  async confirmDecline(request_id: string) {
    const alert = await this.alertController.create({
      header: 'Are you sure you want to proceed?',
      cssClass: 'my-custom-class',
      buttons: [
        {
          text: 'Yes',
          handler: () => {
            this.adminService.declineRequest(request_id).subscribe((data)=>{
              const response = data;
              const parsedResponse = JSON.parse(JSON.stringify(response));
              console.log(parsedResponse);
              if (parsedResponse.status == "success") {
                this.ngOnInit();
              }
            });
          }
        },
        {
          text: 'Cancel',
          role: 'cancel',
        }
      ]
    });
    await alert.present();
  }

  goToHome(){
    this.router.navigate(['/home']);
  }

  goToPanel(){
    this.router.navigate(['/panel']);
  }

}
