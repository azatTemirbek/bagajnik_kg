
export interface ILuggage {
    id: Number;
    //owner_id: Number;
    start_dt: Date;
    end_dt: Date;
    taker_id: Number;
    takerName: String;
    takerPhone1: String;
    takerPhone2: String;
    mass: any;
    comertial: boolean;
    value: String;
    from_lat: any;
    from_lng: any;
    price: any;
    from_formatted_address: String;
    from_place_id: any;
    to_lat: any;
    to_lng: any;
    to_formatted_address: String;
    to_place_id: any;

}
