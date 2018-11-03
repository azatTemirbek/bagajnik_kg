export class Trip {
  id: Number;
  carrier_id: Number;
  start_dt: Date;
  end_dt: Date;
  from_lat: any;
  from_lng: any;
  from_formatted_address: String;
  from_place_id: any;
  to_lat: any;
  to_lng: any;
  to_formatted_address: String;
  to_place_id: any;
}

export interface ITrip {
  id: Number;
  attributes: {
    carrier_id: Number,
    start_dt: Date,
    end_dt: Date,
    from_lat: any,
    from_lng: any,
    from_formatted_address: String,
    from_place_id: any,
    to_lat: any,
    to_lng: any,
    to_formatted_address: String,
    to_place_id: any,
  };
}

