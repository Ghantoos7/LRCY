import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { MenuController } from '@ionic/angular';
import { AlertController } from '@ionic/angular';
import { AdminService } from 'src/app/services/admin.service';

@Component({
  selector: 'app-edit-gallery',
  templateUrl: './edit-gallery.page.html',
  styleUrls: ['./edit-gallery.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class EditGalleryPage implements OnInit {

  branch_id = localStorage.getItem('branch_id') as string;
  allUsers: any[] = [];
  event_id : any;
  selectedUsers: any[] = [];
  event_title : string = "";
  event_description : string = "";
  event_date : string = "";
  event_type_id: string = "";
  program_id: string = "";
  event_main_picture : string = "";
  event_location : string = "";
  budget_sheet : string = "";
  proposal : string = "";
  meeting_minute : string = "";
  photoInputs: Array<number> = [0];
  event_photos: Array<string> = [];
  responsibles : any [] = [];
  originalUsers: any[] = [];
  images: any[] = [];
  event_photo:string="";
new_event_main_picture:string='';

  constructor(private router:Router, private menuController: MenuController, private alertController: AlertController, private adminService : AdminService) { }

  ngOnInit() {
    const event = history.state.event;
    this.event_id = event.id;
    this.event_title = event.event_title;
    this.event_description = event.event_description;
    this.event_date = event.event_date;
    this.event_type_id = this.mapEventTypeId(event.event_type_id);
    this.program_id = this.mapProgramId(event.program_id);
    this.event_main_picture = event.event_main_picture;
    this.event_location = event.event_location;
    this.budget_sheet = event.budget_sheet;
    this.proposal = event.proposal;
    this.meeting_minute = event.meeting_minute;
    this.responsibles = event.responsibles;

    
    this.adminService.getUserInfo(this.branch_id,"").subscribe((response: any) => {
      this.allUsers = response['users'];
      this.originalUsers = response['users'];
    });

    this.adminService.getEventPictures(this.event_id).subscribe((response: any) => {
      this.images = response.pictures;
    });
  }

  

  editGalleryEvent() {
    const formData = new FormData();
    formData.append('event_id', this.event_id);
    formData.append('event_title', this.event_title);
    formData.append('event_description', this.event_description);
    formData.append('event_date', this.event_date);
    formData.append('event_type_id',  this.mapEventType(this.event_type_id).toString());
    formData.append('program_id',  this.mapProgramName(this.program_id).toString());
    formData.append('event_main_picture',  this.event_main_picture);
    formData.append('event_location',  this.event_location);
    formData.append('event_main_picture',  this.event_main_picture);
    formData.append('budget_sheet',  this.budget_sheet);
    formData.append('proposal',  this.proposal);
    formData.append('meeting_minute', this.meeting_minute);
    const data = JSON.stringify(this.transformData(this.selectedUsers));
    formData.append('responsibles', data);
    const event_photos = JSON.stringify(this.event_photos);
    formData.append('event_images', event_photos);
    
    this.adminService.editEvent(formData).subscribe((response: any) => {
      const parsedResponse = JSON.parse(JSON.stringify(response));
      console.log(parsedResponse);
      if(parsedResponse.status == 'success') {
        this.alertController.create({
          header: 'Success',
          message: 'Event updated successfully!',
          buttons: ['OK']
        }).then(alert => alert.present());
        this.router.navigate(['/manage-gallery']);
      } else {
        this.alertController.create({
          header: 'Error',
          message: parsedResponse.message,
          buttons: ['OK']
        }).then(alert => alert.present());
      }
    });
  }

  onChange(event: any) {
    this.new_event_main_picture = event.target.files[0];

}

deleteImage(image_id: number){
  this.adminService.removeEventPhoto(image_id).subscribe((response: any) => {
    const parsedResponse = JSON.parse(JSON.stringify(response));
    console.log(response);
    if(parsedResponse.status == 'success') {
      this.alertController.create({
        header: 'Success',
        message: 'Image deleted successfully!',
        buttons: ['OK']
      }).then(alert => alert.present());
      this.router.navigate(['/manage-gallery']);
    } else {
      this.alertController.create({
        header: 'Error',
        message: parsedResponse.message,
        buttons: ['OK']
      }).then(alert => alert.present());
    }
  });
}

onChangeBudget(event: any) {
  this.budget_sheet = event.target.files[0];

}


onChangePhoto(event: any) {
  this.event_photo = event.target.files[0];
  console.log(this.event_photo);
}

onChangeProp(event: any) {
  this.proposal = event.target.files[0];

}

onChangeMeet(event: any) {
  this.meeting_minute = event.target.files[0];

}

addPhoto(){
  const formData = new FormData();
  formData.append('event_id', this.event_id);
  formData.append('image', this.event_photo);
  
  this.adminService.addEventPhoto(formData).subscribe((response: any) => {
    const parsedResponse = JSON.parse(JSON.stringify(response));
    console.log(parsedResponse);
    if(parsedResponse.status == 'success') {
      this.alertController.create({
        header: 'Success',
        message: 'Photo added successfully!',
        buttons: ['OK']
      }).then(alert => alert.present());
      this.router.navigate(['/manage-gallery']);
    } else {
      this.alertController.create({
        header: 'Error',
        message: parsedResponse.message,
        buttons: ['OK']
      }).then(alert => alert.present());
    }
  });
}

  selectUser(user: any, checked: boolean) {
    if (checked) {
      const selectedUser = {
        id: user.id,
        role_name: '',
        first_name: user.first_name,
        last_name: user.last_name,
        user_profile_pic : user.user_profile_pic
      };
      this.selectedUsers.push(selectedUser);
      this.allUsers = this.allUsers.filter(u => u.id !== user.id);
    } else {
      this.removeSelectedUser(user);
    }
  }
  
  updateUserRole(user: any, newRole: string) {
    const userToUpdate = this.selectedUsers.find(u => u.id === user.id);
    if (userToUpdate) {
      userToUpdate.role_name = newRole;
    }
  }

  printball(){
    console.log(this.program_id)
  }

  removeSelectedUser(selectedUser: any) {
    this.selectedUsers = this.selectedUsers.filter(u => u.id !== selectedUser.id);
    const originalUser = this.originalUsers.find(u => u.id === selectedUser.id);
    if (originalUser) {
      this.allUsers.push(originalUser);
    }
  }
  
  addPhotoInput() {
    this.photoInputs.push(this.photoInputs.length);
    console.log(this.event_photos)
  }



removePhotoInput(photoInput: number) {
  const index = this.photoInputs.findIndex(input => input === photoInput);
  if (index > -1) {
    this.photoInputs.splice(index, 1);
    this.event_photos.splice(index, 1);
  }
}

 transformData(inputList: { id: string, role_name: string, first_name: string, last_name: string, user_profile_pic: string }[]): { user_id: string, role_name: string }[] {
  const outputList = inputList.map(item => ({
    user_id: item.id,
    role_name: item.role_name
  }));
  return outputList;
}



mapProgramId(programId: number): string {
  switch(programId) {
    case 1:
      return 'Youth and Health';
    case 2:
      return 'Human values and principles';
    case 3:
      return 'Environment';
    case 4:
      return "Other";
    default:
      return 'error';
  }
}

mapEventTypeId(eventTypeId: number): string {
  switch(eventTypeId) {
    case 1:
      return 'Activity';
    case 2:
      return 'Training';
    case 3:
      return 'Other';
    default:
      return 'Other';
  }
}

mapProgramName(programName: string): number {
  switch(programName) {
    case 'Youth and Health':
      return 1;
    case 'Human values and principles':
      return 2;
    case 'Environment':
      return 3;
    case "Other":
      return 4;
    default:
      return 5;
  }
}

mapEventType(eventType: string): number {
  switch(eventType) {
    case 'Activity':
      return 1;
    case 'Training':
      return 2;
    case 'Other':
      return 3;
    default:
      return 4;
  }
} 

  async confirm() {
    const alert = await this.alertController.create({
      header: 'Delete Event',
      message: 'Are you sure you want to remove this event?',
      cssClass: 'my-custom-class',
      buttons: [
        {
          text: 'Yes',
          handler: () => {
            this.adminService.deleteEvent(this.event_id).subscribe((response: any) => {
                  const parsedResponse = JSON.parse(JSON.stringify(response));
                  if(parsedResponse.status == 'success') {
                    this.alertController.create({
                      header: 'Success',
                      message: 'event deleted successfully',
                      buttons: ['OK']
                    }).then(alert => alert.present());
                    this.router.navigate(['/manage-gallery']);
                  } else {
                    this.alertController.create({
                      header: 'Error',
                      message: parsedResponse.message,
                      buttons: ['OK']
                    }).then(alert => alert.present());
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

  goToPanel(){
    this.router.navigate(['/panel']);
  }

  goToHome(){
    this.adminService.logout().subscribe((response: any) => {
      localStorage.clear();
      this.router.navigate(['/home']);
   });
  }

  goToAddGallery(){
    this.router.navigate(['/add-gallery']);
    }

  goToGallery(){
    this.router.navigate(['/manage-gallery']);
  }
  
  closeMenu() {
    this.menuController.close();
  }
  ionViewWillLeave() {
    this.menuController.enable(false, 'editGallery');
  }

  ionViewDidEnter() {
    this.menuController.enable(true, 'editGallery');
  }
  
}
