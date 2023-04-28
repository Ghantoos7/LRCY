import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { AlertController, IonicModule } from '@ionic/angular';
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

  constructor(private shared:SharedService, private route: ActivatedRoute, private navCtrl: NavController, private router:Router, private service:EventService, private alertController:AlertController) { }

  ngOnInit() {
    this.my_id = this.shared.getVariableValue();
    
    this.service.getEventPictures(this.my_id).subscribe(response => {
     
      this.pictures = response;
   
    });
  }

  downloadPicture(pic_id: number) {
    this.service.downloadPicture(pic_id).subscribe({
      next: (data: string) => {
        const url = 'data:image/jpg;base64,' + data; // Replace 'image/jpeg' with the appropriate MIME type of your images
        const link = document.createElement('a');
        link.href = url;
        link.download = 'image.jpg';
        link.click();
        this.presentSuccessAlert();
      },
      error: () => {
        this.presentErrorAlert();
      }
    });
  }
  
  async presentSuccessAlert() {
    const alert = await this.alertController.create({
      header: 'Success',
      message: 'Image downloaded successfully!',
      buttons: ['OK']
    });
  
    await alert.present();
  }
  
  async presentErrorAlert() {
    const alert = await this.alertController.create({
      header: 'Error',
      message: 'Error downloading image. Please try again later.',
      buttons: ['OK']
    });
  
    await alert.present();
  }

  ionViewWillLeave() {
    
    const navigation = this.router.getCurrentNavigation();
    if (navigation && navigation.extras && navigation.extras.state) {
      navigation.extras.state = { id: null };
    }
  }
}
