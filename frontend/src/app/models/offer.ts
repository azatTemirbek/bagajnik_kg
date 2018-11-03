export class Offer {
  id: Number;
  req_user: Number;
  luggage_id: Number;
  trip_id: Number;
  agree: Boolean;
  status: String;
  isValid() {
    return true;
  }
}
export interface IOffer {
  id: Number;
  req_user: Number;
  luggage_id: Number;
  trip_id: Number;
  agree: Boolean;
  status: String;
}
