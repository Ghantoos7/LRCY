import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router, NavigationEnd } from '@angular/router';
import { MenuController } from '@ionic/angular';
import { AlertController } from '@ionic/angular';
import { AdminService } from 'src/app/services/admin.service';
import { ReactiveFormsModule } from '@angular/forms';
import { FormControl } from '@angular/forms';
import { debounceTime } from 'rxjs/operators';

@Component({
  selector: 'app-announcements',
  templateUrl: './announcements.page.html',
  styleUrls: ['./announcements.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule, ReactiveFormsModule]
})
export class AnnouncementsPage implements OnInit {
  showDescriptions: boolean[] = [];
  announcements: any = [];
  filteredAnnouncements: any = [];
  i: number = 0;
  current_id = localStorage.getItem('admin_id') as string;
  branch_id = localStorage.getItem('branch_id') as string;
  searchControl: FormControl = new FormControl('');
  darkMode: boolean;

  constructor(private alertController: AlertController, private router:Router, private menuController: MenuController, private adminService:AdminService) { 
    this.darkMode = localStorage.getItem('darkModeEnabled') === 'true';
    if (this.darkMode) {
      document.body.setAttribute('color-theme', 'dark');
    } 
    this.showDescriptions = new Array(this.announcements.length).fill(false);
  }

  ngOnInit() {
    this.fetchAnnouncements();

    this.router.events.subscribe((event) => {
      if (event instanceof NavigationEnd && event.url === '/announcements') {
        this.fetchAnnouncements();
      }
    });

    this.searchControl.valueChanges.pipe(debounceTime(300)).subscribe(() => {
      this.onSearchChange();
    });
  }

  fetchAnnouncements() {
    this.adminService.getAnnouncements(this.branch_id).subscribe((response: any) => {
      this.announcements = response['announcements'];
      this.filteredAnnouncements = this.announcements;
    });
  }

  onSearchChange() {
    this.filteredAnnouncements = this.filterAnnouncements(this.searchControl.value);
  }
  
  filterAnnouncements(searchTerm: string) {
    return this.announcements.filter((announcement: any) => {
      return announcement.announcement_title.toLowerCase().includes(searchTerm.toLowerCase());
    });
  }

  
  async confirm(id: string) {
    const alert = await this.alertController.create({
      header: 'Delete Announcement',
      message: 'Are you sure you want to delete this announcement?',
      cssClass: 'my-custom-class',
      buttons: [
        {
          text: 'Yes',
          handler: () => {
            this.adminService.deleteAnnouncement(id, this.current_id).subscribe((response: any) => {
              const parsedResponse = JSON.parse(JSON.stringify(response));
              if(parsedResponse.status == 'success') {
                this.alertController.create({
                  header: 'Success',
                  message: 'Announcement deleted successfully!',
                  buttons: ['OK']
                }).then(alert => alert.present());
                this.ngOnInit();
              } else {
                this.alertController.create({
                  header: 'Error',
                  message: parsedResponse.message,
                  buttons: ['OK']
                }).then(alert => alert.present());
              }
            }
            );
        },
        },
        {
          text: 'Cancel',
          role: 'cancel',
        }
      ]
    });
    await alert.present();
  }

  toggleDescription(index: number) {
    this.showDescriptions[index] = !this.showDescriptions[index];
  }

  goToSendAnnouncement(){
    this.router.navigate(['/send-announcement']);
  }

  goToEditAnnouncement(announcement: any) {
    this.router.navigate(['/edit-announcement'], { state: { announcement: announcement } });
  }

  goToHome(){
    this.adminService.logout().subscribe((response: any) => {
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


  ionViewWillLeave() {
    this.menuController.enable(false, 'menuAnnouncements');
  }

  ionViewDidEnter() {
    this.menuController.enable(true, 'menuAnnouncements');
  }
}
