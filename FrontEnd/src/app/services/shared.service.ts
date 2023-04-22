import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class SharedService {
  private event: any;

  private selectedUser: any;

  constructor() { }

  setVariableValue(value: any) {
    this.event = value;
  }

  getVariableValue() {
    return this.event;
  }

  setSelectedUser(user: any) {
    this.selectedUser = user;
  }

  getSelectedUser() {
    return this.selectedUser;
  }
  
}
