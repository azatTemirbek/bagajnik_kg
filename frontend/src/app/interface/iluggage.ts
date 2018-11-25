
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
    price: any;
    from_formatted_address: String;
    to_formatted_address: String;
    dsc: String;
}
