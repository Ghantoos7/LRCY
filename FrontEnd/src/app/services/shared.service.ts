import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class SharedService {
  private event: any;

  constructor() { }

  setVariableValue(value: any) {
    this.event = value;
  }

  getVariableValue() {
    return this.event;
  }
}
