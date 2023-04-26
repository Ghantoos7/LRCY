import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { MenuController } from '@ionic/angular';
import { AlertController } from '@ionic/angular';
import { AdminService } from 'src/app/services/admin.service';

@Component({
  selector: 'app-add-gallery',
  templateUrl: './add-gallery.page.html',
  styleUrls: ['./add-gallery.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class AddGalleryPage implements OnInit {

  branch_id = localStorage.getItem('branch_id') as string;
  allUsers: any[] = [];
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

  constructor(private router:Router, private menuController: MenuController, private alertController: AlertController, private adminService : AdminService) { }

  ngOnInit() {
    this.adminService.getUserInfo(this.branch_id,"").subscribe((response: any) => {
      this.allUsers = response['users'];
      this.originalUsers = JSON.parse(JSON.stringify(this.allUsers));
    });
  }

  addEvent(){
    const formData = new FormData();
    formData.append('branch_id', this.branch_id);
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
    this.adminService.addEvent(formData).subscribe((response: any) => {
      const parsedResponse = JSON.parse(JSON.stringify(response));
      if(parsedResponse.status == 'success') {
        this.alertController.create({
          header: 'Success',
          message: 'Event added successfully!',
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
    this.event_main_picture = event.target.files[0];

}

onChangeBudget(event: any) {
  this.budget_sheet = event.target.files[0];

}

onChangeProp(event: any) {
  this.proposal = event.target.files[0];

}

onChangeMeet(event: any) {
  this.meeting_minute = event.target.files[0];

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
      console.log(this.selectedUsers);
    } else {
      this.removeSelectedUser(user);
    }
  }
  
  updateUserRole(user: any, newRole: string) {
    const userToUpdate = this.selectedUsers.find(u => u.id === user.id);
    if (userToUpdate) {
      userToUpdate.role_name = newRole;
    }
    console.log(this.selectedUsers);
  }

  removeSelectedUser(selectedUser: any) {
    this.selectedUsers = this.selectedUsers.filter(u => u.id !== selectedUser.id);
    const originalUser = this.originalUsers.find(u => u.id === selectedUser.id);
    if (originalUser) {
      this.allUsers.push(originalUser);
    }
    console.log(this.selectedUsers);
  }
  
  addPhotoInput() {
    this.photoInputs.push(this.photoInputs.length);
  }

  transformData(inputList: { id: string, role_name: string, first_name: string, last_name: string, user_profile_pic: string }[]): { user_id: string, role_name: string }[] {
    const outputList = inputList.map(item => ({
      user_id: item.id,
      role_name: item.role_name
    }));
    return outputList;
  }
  
  removePhotoInput(photoInput: number) {
    const index = this.photoInputs.findIndex(input => input === photoInput);
    if (index > -1) {
      this.photoInputs.splice(index, 1);
      this.event_photos.splice(index, 1);
    }
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

  goToGallery(){
    this.router.navigate(['/manage-gallery']);
  }
  
  closeMenu() {
    this.menuController.close();
  }

  ionViewWillLeave() {
    this.menuController.enable(false, 'menuAddGallery');
  }

  ionViewDidEnter() {
    this.menuController.enable(true, 'menuAddGallery');
  }

}
