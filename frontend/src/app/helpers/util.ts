/**
 * used to parse date from string
 * @param dt date
 */
export const  dateParse = (dt) => {
  dt = new Date(dt);
  return {
    year: dt.getFullYear(),
    month: dt.getMonth(),
    day: dt.getDate()
  };
}
